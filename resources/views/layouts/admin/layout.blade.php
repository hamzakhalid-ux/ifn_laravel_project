
<!DOCTYPE html>
<html lang="en">
    <head>
        @foreach($headSections as $section)
        @include("components/index/$section")
        @endforeach
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;400&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Investor Landing Page</title>
        <link rel="stylesheet" href="assets/css/theme.css">
        <link rel="stylesheet" href="assets/css/buttons.css">
        <link rel="stylesheet" href="assets/css/forms.css">
        <link rel="stylesheet" href="assets/css/cards.css">
        <link rel="stylesheet" href="assets/css/labels.css"> --}}
    </head>
    <body>
        @foreach ($headerSections as $section)
            @include("components/index/$section")
        @endforeach

        @foreach($mainSections as $section)
            @include("components/index/$section")
        @endforeach

        @foreach($footSections as $section)
            @include("components/index/$section")
        @endforeach


    </body>
</html>
