<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $cmId = preg_replace('/[^a-zA-Z0-9_]/', '_', $getId());
    @endphp
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }"
        style="position: relative; border-radius: 0.375rem; overflow-x: scroll;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                const config = {
                    mode: {name: 'javascript', json: true},
                    readOnly: {{ json_encode($isReadOnly()) }},
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                    lineWrapping: {{ json_encode($getHasLineWrapping()) }},
                    autoCloseBrackets: {{ json_encode($getHasAutoCloseBrackets()) }},
                    viewportMargin: Infinity,
                    theme: '{{ $getHasDarkTheme() ? 'material' : 'default' }}',
                    foldGutter: {{ json_encode($getHasFoldingCode()) }},
                    @php
                        if($getHasFoldingCode()) {
                            echo "extraKeys: {'Ctrl-Q': function(cm) { cm.foldCode(cm.getCursor()); }},";
                        }
                    @endphp
                    gutters: {{ json_encode($getGutters()) }},
                    foldOptions: {
                        widget: (from, to) => {
                            var count = undefined;

                            var startToken = '{', endToken = '}';
                            var prevLine = {{ $cmId }}.getLine(from.line);
                            if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {
                                startToken = '[', endToken = ']';
                            }

                            var internal = {{ $cmId }}.getRange(from, to);
                            var toParse = startToken + internal + endToken;

                            try {
                                var parsed = JSON.parse(toParse);
                                count = Object.keys(parsed).length;
                            } catch(e) { }

                            return count ? `\u21A4${count}\u21A6` : '\u2194';
                        }
                    }
                };
                
                {{ $cmId }} = window.CodeMirror($refs.{{ $cmId }}, config);

                {{ $cmId }}.setSize('100%', '100%');
                {{ $cmId }}.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                @php
                    if($getHasFoldedCode()) {
                        echo "$cmId.foldCode(window.CodeMirror.Pos(0, 0));";
                    }
                @endphp

                setTimeout(function() {
                        {{ $cmId }}.refresh();
                }, 1);

                @if(!$isReadOnly())
                {{ $cmId }}.on('change', function () {
                    try {
                        state = JSON.parse({{ $cmId }}.getValue())
                    } catch (e) {
                        state = {{ $cmId }}.getValue();
                    }
                });
                @endif
            "
        >
            <div
                wire:ignore
                x-ref="{{ $cmId }}"
            ></div>
        </div>
    </div>
</x-dynamic-component>