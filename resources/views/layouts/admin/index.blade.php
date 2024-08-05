<!DOCTYPE html>
<html lang="en">
    {{-- <head> --}}
        @foreach($headSections as $section)
        @include("components/index/$section")
        @endforeach
    {{-- </head> --}}
    <body>

        @foreach ($headerSections as $section)
            @include("components/index/$section")
        @endforeach
        <main class="{{$main_class}}">
            <div class="container">
                @foreach($mainSections as $section)
                @include("components/index/$section")
                @endforeach
            </div>
        </main>

        @foreach($footSections as $section)
        @include("components/index/$section")
        @endforeach

    </body>
</html>
