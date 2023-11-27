
@extends('admin::layouts.master')

@section('content-wrapper')

<display-field :data='@json($person)'></display-field>

{{--{{$person->approach_time}}--}}


@endsection
@once
    @push('scripts')

        <style>

        </style>

        <script type="text/x-template" id="display-field-template">
            <div class="content full-page dashboard">
                <div class="dashboard-content">
                    <div class="row-grid-3">
            <div class="timer card">
                <div class="card-data display-grid">
                    <label class="card-header">@{{ data.name }}</label>
                    <div class="column-container">
                        <span></span>
                        <span>Описание: @{{ data.description }}</span>
                    </div>
                    <div class="column-container">
                        <span></span>
                        <span>Количество повторений: @{{ data.number_repetitions }}</span>
                    </div>
                    <div class="column-container">
                        <span></span>
                        <span>Количество подходов: @{{ data.number_approaches }}</span>
                    </div>
                    <div class="column-container">
                        <span></span>
                        <span>@{{ minutes }} секунд</span>
                    </div>
                </div>
                <br>
                <button type="submit" @click="startTimer" class="btn btn-sm btn-secondary-outline">
                    Запустить таймер
                </button>
            </div>
            </div></div>
            </div>
        </script>

        <script>
            Vue.component('display-field', {

                template: '#display-field-template',

                props: ['data'],

                data() {
                    return {
                        number_repetitions: this.data.number_repetitions,
                        minutes: '0:00',
                        time: 0,
                        data: []
                    };
                },
                methods: {
                    startTimer() {
                        this.approachTime(this.data.approach_time, 'run')
                    },
                    approachTime(time, action) {
                        // if (typeof this.time === 'string') {
                            this.time = this.timeToSeconds(time);
                        // }
                        const interval = setInterval(() => {
                            this.time--;
                            this.secondsToMMSS(this.time, action)
                            if (this.data.number_repetitions === 0){
                                clearInterval(interval);
                                if (this.data.number_approaches === 0) {
                                    alert('Время вышло!');
                                    clearInterval(interval);
                                } else {20
                                    this.data.number_approaches--;
                                    this.data.number_repetitions = this.number_repetitions;
                                    this.approachTime(this.data.rest_between_approaches, 'pause')
                                }
                            }
                            else if (this.time === 0 && action === 'run') {
                                clearInterval(interval);
                                this.approachTime(this.data.pause_time, 'pause')
                                this.data.number_repetitions--;
                            }
                            else if (this.time === 0 && action === 'pause') {
                                clearInterval(interval);
                                this.approachTime(this.data.approach_time, 'run')
                            }
                        }, 1000);
                    },
                     timeToSeconds(time) {
                        const [minutes, sec] = time.split(':').map(Number);
                        return minutes * 60 + sec;
                    },
                    // Форматируем время для отображения
                     secondsToMMSS(seconds, action) {
                        minutes = Math.floor(seconds / 60);
                        seconds = seconds % 60;

                        if (minutes < 10) {
                            minutes = '0' + minutes;
                        }

                        if (seconds < 10) {
                            seconds = '0' + seconds;
                        }

                        if (action === 'run') {
                            this.minutes = 'Время подхода: ' + minutes + ':' + seconds;
                        }
                         if (action === 'pause') {
                             this.minutes = 'Время отдыха: ' + minutes + ':' + seconds;
                         }
                     }
                },

            });
        </script>

    @endpush
@endonce