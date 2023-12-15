<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .item-variations input[type=checkbox] {
            accent-color: red;
            background-color: red;
            height: 40px;
            width: 40px;
            border-radius: 6px;
            border: 2px solid #cdbbbb;
            margin: 6px;
        }

        .item-variations input[type=checkbox]:checked {
            accent-color: red;
            background-color: red;
        }

        .item-variations .shade-container {
            position: relative;
            display: inline-block;
        }

        .item-variations .tooltip {
            visibility: hidden;
            width: max-content;
            background-color: #f1f1f1;
            color: #333;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 115%;
            left: 50%;
            margin-left: -60px;
            /* Adjust this value to center the tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        .shade-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    @php
        $stockDisplayFormat = preference('stock_display_format');
        $lowStockThreshold = $product->getStockThreshold();
    @endphp

    @if ($product->isVariableProduct() && is_array($filterVariation) && count($filterVariation) > 0)
        @php
            $count = 0;
            $position = 1;
        @endphp

        @foreach ($filterVariation['attrbuteIdsWithKey'] as $key => $attrbuteIdWithKey)
            <div class="flex mt-4 md:mt-3 option-select items-center">
                <div class="grid-2 grid-cols-7 gap-2 item-variations">
                    @foreach ($attrbuteIdWithKey as $value)
                        @if ($value != '')
                            @php
                                $details = null;
                                if (isset($attribute_values[$key])) {
                                    $details = $attribute_values[$key]->where('id', $value)->first();
                                }
                                $backValue = isset($details) ? $details->id : $value;
                            @endphp
                            <div class="shade-container">
                                @if (
                                    !is_null($details) &&
                                        ($shadeColor = DB::table('product_shades')->where('product_name', $name)->where('shade_name', $details->value)->get()))
                                    @foreach ($shadeColor as $Color)
                                        <input type="checkbox" style="background-color:{{ $Color->shade_color }}"
                                            class="border border-gray-2 rounded p-2 cursor-pointer"
                                            value="{{ $details->value }}" data-id="{{ $details->id }}"
                                            {{ isset($default_attributes[$key]) && $default_attributes[$key] == $backValue ? 'selected' : '' }}
                                            data-position="{{ $position }}">
                                        <div class="tooltip">
                                            {{ $details->value }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>


            @php
                $position++;
            @endphp
        @endforeach

        <label class="error display-none" id="availability">{{ __('Not Available') }}</label>

        <div class="flex justify-between items-center mt-22p ltr:mr-10 rtl:ml-10">
            <div class="flex justify-start items-center">
                <span class="text-gray-12 text-sm roboto-medium leading-4 display-none font-medium" id="stock_qty">
                </span>
            </div>

            <a href="javascript:void(0)" class="flex justify-start items-center display-none" id="clear-variation">
                <span
                    class="text-gray-10 text-sm roboto-medium leading-4 font-medium ltr:mr-1 rtl:ml-1">{{ __('Clear') }}</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        fill="none">
                        path fill-rule="evenodd" clip-rule="evenodd" d="M8.8617 9.52856L9.80451 10.4714L7.60925
                        12.6666L9.80451 14.8619L8.8617 15.8047L5.72363 12.6666L8.8617 9.52856Z" fill="#898989"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.7078 5.08931C11.3889 5.2734 11.2797 5.68113 11.4638 5.99999C11.8148 6.60807 11.9997 7.29784 11.9997 7.99999C11.9997 8.70214 11.8148 9.39191 11.4638 9.99999C11.1127 10.6081 10.6078 11.113 9.99967 11.4641C9.3916 11.8152 8.70182 12 7.99967 12C7.63149 12 7.33301 12.2985 7.33301 12.6667C7.33301 13.0348 7.63149 13.3333 7.99967 13.3333C8.93587 13.3333 9.85557 13.0869 10.6663 12.6188C11.4771 12.1507 12.1504 11.4774 12.6185 10.6667C13.0866 9.85589 13.333 8.93619 13.333 7.99999C13.333 7.06379 13.0866 6.14409 12.6185 5.33332C12.4344 5.01446 12.0267 4.90521 11.7078 5.08931Z"
                            fill="#898989" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.1383 6.47144L6.19549 5.52863L8.39075 3.33336L6.19549 1.1381L7.1383 0.195293L10.2764 3.33336L7.1383 6.47144Z"
                            fill="#898989" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.29221 10.9107C4.61107 10.7266 4.72032 10.3189 4.53622 10C4.18515 9.39193 4.00033 8.70216 4.00033 8.00001C4.00033 7.29786 4.18515 6.60809 4.53622 6.00001C4.8873 5.39193 5.39225 4.88698 6.00033 4.53591C6.6084 4.18484 7.29818 4.00001 8.00033 4.00001C8.36851 4.00001 8.66699 3.70153 8.66699 3.33334C8.66699 2.96515 8.36851 2.66668 8.00033 2.66668C7.06413 2.66668 6.14443 2.91311 5.33366 3.38121C4.52289 3.84931 3.84962 4.52257 3.38152 5.33334C2.91343 6.14411 2.66699 7.06381 2.66699 8.00001C2.66699 8.93621 2.91343 9.85591 3.38152 10.6667C3.56562 10.9855 3.97335 11.0948 4.29221 10.9107Z"
                            fill="#898989" />
                    </svg>
                </span>
            </a>
        </div>
    @elseif(
        $manage_stocks == 1 &&
            $stock_status == 'In Stock' &&
            $stock_hide == 0 &&
            $stock_quantity >= 0 &&
            !is_null($stock_quantity))
        @if ($stockDisplayFormat == 'always_show')
            <div class="mt-22p">
                <span class="text-gray-12 text-sm roboto-medium leading-4 font-medium ltr:ml-1 rtl:mr-1"
                    id="stock_qtyV">
                    <span
                        class="text-green-1 leading-4 bg-green-2 px-4 py-2 text-sm roboto-medium font-medium rounded ltr:mr-2.5 rtl:ml-2.5">{{ __('In Stock') }}</span>
                    <span class="ml-1">{{ __(':x items remaining', ['x' => $stock_quantity]) }}</span>
                </span>
            </div>
        @elseif($stockDisplayFormat == 'sometime_show' && $stock_quantity <= $lowStockThreshold && $lowStockThreshold != 0)
            <div class="mt-22p">
                <span class="text-gray-12 text-sm roboto-medium font-medium"
                    id="stock_qty">{{ __('Only :x left in stock.', ['x' => $stock_quantity]) }}</span>
            </div>
        @endif
    @elseif(
        ($manage_stocks == 0 && $stock_status == 'Out Of Stock') ||
            ($manage_stocks == 1 && $stock_hide == 0 && $stock_quantity <= 0 && $backorders == 0))
        @if ($stockDisplayFormat == 'always_show' || $stockDisplayFormat == 'sometime_show')
            <div Class="mt-22p">
                <span class="text-reds-3 mr-1 leading-4 bg-pinks-2 px-4 py-2 text-sm roboto-medium font-medium rounded"
                    id="stock_qty">{{ __('Out Of Stock') }}</span>
            </div>
        @endif
    @endif
</body>
