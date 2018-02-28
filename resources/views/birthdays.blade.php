@if(\App\BirthdayHelper::getBirthdays()->count() > 0)
    <ul class="birthdays">
        @foreach(\App\BirthdayHelper::getBirthdays() as $date)
            <li>{{ \Carbon\Carbon::parse($date->birthday)->format('jS F Y') }} <span title="Exchange rate"><b>{{ $date->rate }}</b></span> <em title="Times requested">({{ $date->times_requested }})</em></li>
        @endforeach
    </ul>
@endif