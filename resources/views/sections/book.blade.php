<div class="col-lg-3 book-container">
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="text-center">{{{ substr($book -> title, 0, 17) }}}</h3>
            <div class="img-container">
                {!! HTML::image(url($book -> cover_large)); !!}
            </div>
            {{{ substr($book -> resume, 0, 140    ) }}}..
            <a href="{{{ url('books/' . $book -> id) }}}" class="btn btn-block btn-default btn-sm">read more</a>
        </div>
        <div class="panel-footer text-center"><span
                    class="bold">Published:</span> {{{ date('d/m/Y', strtotime($book -> publish)) }}}
        </div>
    </div>
</div>