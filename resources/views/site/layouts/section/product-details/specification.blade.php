<div class="c-tab mt-6" id="product-specification-panel">
    <div class="c-tab__content -mt-5 md:-mt-0">
        <div class="rounded my-6" style="text-transform:lowercase; !important">
            @if (!empty($attributes))
                @foreach ($attributes as $attribute)
                    @if ($attribute['visibility'] == 1)
                        @php
                            $len = count($attribute['value']);
                            $i = 1;
                            $result = null; // Initialize $result here
                        @endphp
                        @foreach ($attribute['value'] as $attValue)
                            @php
                                if (isset($attribute_values[$attribute['key']])) {
                                    $dataQuery = $attribute_values[$attribute['key']]->where('id', $attValue)->first();
                                    if (!empty($dataQuery)) {
                                        $result = $dataQuery->value;
                                    }
                                }
                            @endphp
                            {{ $result }}
                            {{ $len > $i ? ',' : null }}
                            @php $i++ @endphp
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
