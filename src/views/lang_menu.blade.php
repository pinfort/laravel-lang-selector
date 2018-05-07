<li class="dropdown">
    <a href="#" class="dropdown-toggle language-dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        🌏{{ $site_available_languages[$user_current_language] }}
    </a>
    <ul class="dropdown-menu language-dropdown-menu" role="menu">
        {{-- parce...はクエリパラメータがあるとき'&'を返しそうでなければ'?'を返す。エスケープされないため!!にしている --}}
        @foreach ($site_available_languages as $lang_code => $lang_name)
            <li><a href="{{ Request::fullUrl() }}{!! is_null(parse_url(Request::fullUrl(), PHP_URL_QUERY)) ? '?' : '&' !!}lang={{ $lang_code }}">{{ $lang_name }}</a></li>
        @endforeach
    </ul>
</li>
