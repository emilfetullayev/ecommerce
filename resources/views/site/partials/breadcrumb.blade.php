<ul class="breadcrumb">
    @isset($section_title)
        <h1>{{ $section_title }}</h1>
    @endisset


    <li>
        @isset($home_title)
            <a href="{{ route('home') }}">
                <i class="fa fa-home"></i>
                {{ $home_title }}
            </a>
        @endisset
    </li>


    @isset($title)
        <li class="active">
            <span>{{ $title }}</span>
        </li>
    @endisset

</ul>
