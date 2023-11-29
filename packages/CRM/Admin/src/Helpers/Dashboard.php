<?php

namespace CRM\Admin\Helpers;

use Carbon\Carbon;
use CRM\Call\Repositories\DailyCallPlanRepository;
use Webkul\Activity\Repositories\ActivityRepository;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\Email\Repositories\EmailRepository;
use Webkul\Lead\Repositories\LeadRepository;
use Webkul\UI\DataGrid\DataGrid;

class Dashboard extends DataGrid
{
    use ProvideDropdownOptions;
    /**
     * Cards.
     *
     * @var array
     */
    protected $cards;

    /**
     * Lead repository instance.
     *
     * @var \Webkul\Lead\Repositories\LeadRepository
     */
    protected $leadRepository;

    /**
     * Person repository instance.
     *
     * @var \Webkul\Contact\Repositories\PersonRepository
     */
    protected $personRepository;

    /**
     * Activity repository instance.
     *
     * @var \Webkul\Activity\Repositories\ActivityRepository
     */
    protected $activityRepository;

    /**
     * User repository instance.
     *
     * @var \Webkul\User\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Email repository instance.
     *
     * @var \Webkul\Email\Repositories\EmailRepository
     */
    protected $emailRepository;

    protected $dailyCallPlanRepository;

    /**
     * Create a new helper instance.
     *
     * @param  \Webkul\Lead\Repositories\LeadRepository  $leadRepository
     * @param  \Webkul\Lead\Repositories\PipelineRepository  $pipelineRepository
     * @param  \Webkul\Lead\Repositories\ProductRepository  $leadProductRepository
     * @param  \Webkul\Quote\Repositories\QuoteRepository  $quoteRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @param  \Webkul\Product\Repositories\PersonRepository  $personRepository
     * @param  \Webkul\Product\Repositories\ActivityRepository  $activityRepository
     * @param  \Webkul\Product\Repositories\UserRepository  $userRepository
     * @param  \Webkul\Email\Repositories\EmailRepository  $emailRepository
     * @return void
     */
    public function __construct(
        LeadRepository $leadRepository,
        ActivityRepository $activityRepository,
        EmailRepository $emailRepository,
//        DailyCallPlanRepository $dailyCallPlanRepository
    ) {
        $this->leadRepository = $leadRepository;
        
        $this->activityRepository = $activityRepository;
        
        $this->emailRepository = $emailRepository;
        
//        $this->dailyCallPlanRepository = $dailyCallPlanRepository;
    }

    /**
     * This will set all available cards data to be displayed on dashboard.
     *
     * @return void
     */
    public function setCards()
    {
        $this->cards = array_map(function ($card) {
            if (isset($card['label'])) {
                $card['label'] = trans($card['label']);
            }

            return $card;
        }, config('statistics_cards'));
    }

    /**
     * This will set all available cards data to be displayed on dashboard.
     *
     * @return array
     */
    public function getCards(): array
    {
        if(! $this->cards) {
            $this->setCards();
        }

        return $this->cards;
    }
    
    public function getCalls($startDateFilter, $endDateFilter, $totalWeeks)
    {
        $filters = request()->input('filter');
        $currentUser = auth()->guard()->user();
        
        if ($filters) {
            $childAgent = get_object_vars(json_decode($filters)->columns);
            $agent = app('\CRM\Agent\Repositories\AgentRepository')->where($childAgent)->firstOrFail();
            $dailyCallPlans = $this->dailyCallPlanRepository
                ->whereBetween('created_at', [$startDateFilter, $endDateFilter])
                ->where($childAgent)
                ->orderBy('scheduled_at', 'desc')
                ->get();
        } else {
            $agent = app('\CRM\Agent\Repositories\AgentRepository')->where('child_id', '=', $currentUser->id)->first();
            
            if(empty($agent)) {
                return [];  
            }
            
            $dailyCallPlans = $this->dailyCallPlanRepository
                ->whereBetween('created_at', [$startDateFilter, $endDateFilter])
                ->where('child_id', $agent->child_id)
                ->orderBy('scheduled_at', 'desc')
                ->get();
        }
        
        $out = [];
        
        $statistics = $dailyCallPlans->filter(function ($dailyCallPlan) {
            $now = Carbon::now();
            $month = $now->month;
            $date = Carbon::parse($dailyCallPlan->scheduled_at);
            return $date->month == $month;
        });

        $totalSuccess = $statistics->map(function ($item) {
            return $item->success;
        })->sum();

        $totalSatisfactory = $statistics->map(function ($item) {
            return $item->satisfactory;
        })->sum();
        
        $totalUnsuccessful = $statistics->map(function ($item) {
            return $item->unsuccessful;
        })->sum();
        
        $filtered = $statistics->filter(function ($dailyCallPlan) {
            $date = Carbon::parse($dailyCallPlan->scheduled_at);
            return $date->isToday();
        });
        
        $dailyCallPlan = count($filtered) > 0 ? $filtered->first() : $statistics->first(); //count($filtered) != 0 ? $filtered : $dailyCallPlans[0];
  
        $data = [];
        $data['label'] = 'Проведено переговоров';
        $data['count'] = $dailyCallPlan->success + $dailyCallPlan->satisfactory + $dailyCallPlan->unsuccessful;
        $data['total'] = $dailyCallPlan->total;
        $data['type'] = 'total';
        $out[] = $data;

        $data = [];
        $data['label'] = 'Количество успешных звонков';
        $data['count'] = $dailyCallPlan->success;
        $data['total'] = $dailyCallPlan->total;
        $data['type'] = 'success';
        $out[] = $data;
        
        $data = [];
        $data['label'] = 'Количество отказных';
        $data['count'] = $dailyCallPlan->unsuccessful;
        $data['total'] = $dailyCallPlan->total;
        $data['type'] = 'unsuccessful';
        $out[] = $data;
        

        $actualCalls = $totalSuccess + $totalSatisfactory + $totalUnsuccessful;
        
        $cardData = [
            "data" => $out,
            "statistics" => [
                [
                    'label' => 'Звонков совершено',
                    'count' => $actualCalls,
                    'type' => 'actualCalls'
                ],
                [
                    'label' => 'Процент выполнения плана',
                    'count' =>  round(($actualCalls / $agent->total_calls_month) * 100, 2),
                    'type' => 'percentage'
                ],
                [
                    'label' => 'Минимальный план звонков',
                    'count' => $agent->total_calls_month,
                    'type' => 'totalCallsMonth'
                ],
                [
                    'label' => 'Успешные переговоры',
                    'count' => $totalSuccess,
                    'type' => 'totalSuccess'
                ],
                [
                    'label' => 'Удовлетворительные переговоры',
                    'count' => $totalSatisfactory,
                    'type' => 'totalSatisfactory'
                ],
                [
                    'label' => 'Неудачные переговоры',
                    'count' => $totalUnsuccessful,
                    'type' => 'totalUnsuccessful'
                ],
                [
                    'label' => 'Невыполненный план',
                    'count' => $agent->total_calls_month - $actualCalls,
                    'type' => 'unfulfilledPlan'
                ],
            ]
        ];

        $cardData['last_day'] = Carbon::parse($dailyCallPlan->scheduled_at)->format('Y.m.d');
        $cardData['is_today'] = count($filtered) > 0;
        
        return $cardData;
    }

    public function callsMadePerDay()
    {
        $currentUser = auth()->guard()->user();
        
        $agent = app('\CRM\Agent\Repositories\AgentRepository')->where('child_id', '=', $currentUser->id)->first();

        if(empty($agent)) {
            return [];
        }

        $dailyCallPlans = $this->dailyCallPlanRepository
            ->where('created_at', Carbon::now()->format('Y-m-d'))
            ->where('child_id', $agent->child_id)
            ->orderBy('scheduled_at', 'desc')
            ->get();
        
        $out = [];

        $statistics = $dailyCallPlans->filter(function ($dailyCallPlan) {
            $now = Carbon::now();
            $month = $now->month;
            $date = Carbon::parse($dailyCallPlan->scheduled_at);
            return $date->month == $month;
        });
        
        $filtered = $statistics->filter(function ($dailyCallPlan) {
            $date = Carbon::parse($dailyCallPlan->scheduled_at);
            return $date->isToday();
        });

        $dailyCallPlan = count($filtered) > 0 ? $filtered->first() : $statistics->first();

        $data = [];
        $data['label'] = 'За текущий день вы совершили:';
        $data['count'] = $dailyCallPlan ? $dailyCallPlan->success + $dailyCallPlan->satisfactory + $dailyCallPlan->unsuccessful : 0;
        $data['type'] = 'total';
        
        return $data;
    }
    
    /**
     * This will return date range to be applied on dashboard data.
     *
     * @param  array  $data
     * @return array
     */
    public function getDateRangeDetails($data)
    {
        $cardId = $data['card-id'];

        $dateRange = $data['date-range'] ?? Carbon::now()->subMonth()->addDays(1)->format('Y-m-d') . "," . Carbon::now()->format('Y-m-d');
        $dateRange = explode(",", $dateRange);

        $startDateFilter = $dateRange[0] . ' ' . Carbon::parse('00:01')->format('H:i');
        $endDateFilter = $dateRange[1] . ' ' . Carbon::parse('23:59')->format('H:i');

        $startDate = Carbon::parse($startDateFilter);
        $endDate = Carbon::parse($endDateFilter);

        $totalWeeks = ceil($startDate->floatDiffInWeeks($endDate));

        return compact(
            'cardId',
            'startDate',
            'endDate',
            'totalWeeks',
            'startDateFilter',
            'endDateFilter'
        );
    }

    /**
     * Format dates of filter.
     *
     * @param  array  $data
     * @return array
     */
    public function getFormattedDateRange($data)
    {
        $labels = $data['labels'];
        $currentIndex = $data['index'];
        $totalWeeks = $data['total_weeks'];

        $startDate = Carbon::parse($data["start_date"]);
        $endDate = Carbon::parse($data["end_date"]);

        array_push($labels, __("admin::app.dashboard.week") . (($totalWeeks + 1) - $currentIndex));

        $startDate = $currentIndex != $totalWeeks
            ? $startDate->addDays((7 * ($totalWeeks - $currentIndex)) + ($totalWeeks - $currentIndex))
            : $startDate->addDays(7 * ($totalWeeks - $currentIndex));

        $endDate = $currentIndex == 1 ? $endDate->addDays(1) : (clone $startDate)->addDays(7);

        $startDate = $startDate->format('Y-m-d  00:00:01');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        return compact('startDate', 'endDate', 'labels');
    }

    /**
     * Collect card data based on `cardId`.
     *
     * @param  array  $requestData
     * @return array|boolean
     */
    public function getFormattedCardData($requestData)
    {
        $relevantFunction = false;

        list(
            'cardId'          => $cardId,
            'endDate'         => $endDate,
            'startDate'       => $startDate,
            'totalWeeks'      => $totalWeeks,
            'endDateFilter'   => $endDateFilter,
            'startDateFilter' => $startDateFilter,
        ) = $this->getDateRangeDetails($requestData);

        foreach ($this->getCards() as $card) {
            if (isset($card['card_id']) && $card['card_id'] == $cardId) {
                if (isset($card['class_name'])) {
                    $class = app($card['class_name']);
                }

                if (isset($card['method_name'])) {
                    $relevantFunction = $card['method_name'];
                }
            }
        }

        $class = $class ?? $this;

        if (! $relevantFunction) {
            $relevantFunction = "get" . str_replace(" ", "", ucwords(str_replace("_", " ", $cardId)));
        }

        if (! method_exists($class ?? $this, $relevantFunction)) {
            $relevantFunction = false;
        }

        $cardData = $relevantFunction
            ? $class->{$relevantFunction}(
                $startDateFilter,
                $endDateFilter,
                $totalWeeks
            )
            : $cardData ?? false;

        return $cardData;
    }

    public function prepareQueryBuilder()
    {
        // TODO: Implement prepareQueryBuilder() method.
    }

    public function addColumns()
    {
        // TODO: Implement addColumns() method.
    }
}
