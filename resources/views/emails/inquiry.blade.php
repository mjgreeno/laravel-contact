<!DOCTYPE html>
<html lang="en">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/tachyons/css/tachyons.min.css">
<body>
<article class="cf ph3 ph5-ns pv5">
    <header class="fn fl-ns w-50-ns pr4-ns">
        <h1 class="f2 lh-title fw9 mb3 mt0 pt3 bt bw2">
            {{ $name }}
        </h1>
        <h2 class="f3 mid-gray lh-title">
            {{ $email }}
        </h2>
        @if ($phone != null)
            <h2 class="f3 mid-gray lh-title">
                {{ $phone }}
            </h2>
        @endif
    </header>
    <div class="fn fl-ns w-50-ns">
        <p class="f5 lh-copy measure mt0-ns">
           {{ $inquiry }}
        </p>
    </div>
</article>
</body>
</html>