<a href="@{{ url }}" title="@{{ title }}" style="display: @{{ loaded() ? 'block': 'none' }}">
    <img class="article-image" data-bind="attr: { src: image }" alt="@{{ title }}" />
</a>


<div class="article-description">
    <div class="article-tags">
        @{{#foreach tags.splice(0, 5)}}
            <a href="#" class="article-tag" style="color: @{{ color }}">
                @{{ name }}
            </a>
        @{{/foreach}}
    </div>

    <h3>
        <a href="@{{ url }}">
            @{{ title }}
        </a>
    </h3>

    <span class="article-author">
        @{{ user.name }}
    </span>

    <time class="article-time" datetime="#">
        @{{ published_at }}
    </time>

    <div class="article-content">
        <hr />
        <br />

        @{{{ preview }}}
    </div>

    <footer>
        <a class="button" href="@{{ url }}">
            Читать далее
        </a>
    </footer>
</div>
