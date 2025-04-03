<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        <section class="vh-100">
            @include('components.sidebar')
            <div class="vw-100 vh-100 bg-danger pe-5" style="padding-left: 7em">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad iure dolores fugit eaque soluta vel nulla debitis nihil, dolorum cupiditate, temporibus numquam, dolore id at. Illo, culpa. Totam, nihil deleniti.
            </div>
        </section>
    </body>
</html>