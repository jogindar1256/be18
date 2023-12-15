<style>
    button>span {
        font-size: 16px;
    }

    p {
        margin: 0;
        !important
    }
</style>
<div class="c-tab md:mt-6" id="product-faq-panel">
    <div class="c-tab__content">
        <div id="item-details-section">
            <div id="item-details" class="h-96 unreset overflow-hidden relative item-full-details mt-5 md:mt-0">
                <div>
                    <div>
                        <h3 class="sr-only">{{ __('FAQs') }}</h3>
                        {{-- {{ __('product name of :x', ['x' => $name]) }} --}}

                        <div class="space-y-6 list-style mb-20 roboto-medium text-sm md:text-15 text-black-10">
                            <div id="accordion-collapse" data-accordion="collapse">
                                @if ($faqItems = DB::table('product_faq')->where('product_name', $name)->get())
                                    @foreach ($faqItems as $faq)
                                        <h2 id="accordion-collapse-heading-{{ $loop->index }}">
                                            <button type="button"
                                                class="flex items-center justify-between w-full py-1 px-4 font-medium rtl:text-right border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                                data-accordion-target="#accordion-collapse-body-{{ $loop->index }}"
                                                aria-expanded="true"
                                                aria-controls="accordion-collapse-body-{{ $loop->index }}">
                                                <span>{{ $faq->question }}</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </button>
                                        </h2>
                                        <div id="accordion-collapse-body-{{ $loop->index }}" class="hidden"
                                            aria-labelledby="accordion-collapse-heading-{{ $loop->index }}">
                                            <div
                                                class="p-2 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                                <p class="mb-1">{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- ... (similar structure for other accordion items) -->
                            </div>
                        </div>
                    </div>
                </div>
                @if (strlen(strip_tags($description)) > 1667 ||
                        strpos($description, '<img src') ||
                        substr_count($description, '<li>') > 5 ||
                        substr_count($description, '<p>') > 5)
                    <div id="view-more-faq" class="absolute justify-center flex inset-x-0 bottom-0 add">
                        <div class="mb-2 mt-8 px-6 py-1 cursor-pointer rounded-sm">
                            <a class="flex justify-center">
                                <span
                                    class=" ltr:pr-5p rtl:pl-5p text-sm dm-sans font-medium text-black-10">{{ __('See More') }}</span>
                                <svg class="mt-2" width="11" height="7" viewBox="0 0 11 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 5L4.83564 5.74741L5.5 6.33796L6.16436 5.74741L5.5 5ZM0.335636 1.74741L4.83564 5.74741L6.16436 4.25259L1.66436 0.252591L0.335636 1.74741ZM6.16436 5.74741L10.6644 1.74741L9.33564 0.252591L4.83564 4.25259L6.16436 5.74741Z"
                                        fill="#898989" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionHeaders = document.querySelectorAll('[data-accordion-target]');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-accordion-target');
                const targetBody = document.querySelector(targetId);

                if (targetBody.classList.contains('hidden')) {
                    // If the target body is hidden, show it
                    targetBody.classList.remove('hidden');
                    this.setAttribute('aria-expanded', 'true');
                } else {
                    // If the target body is visible, hide it
                    targetBody.classList.add('hidden');
                    this.setAttribute('aria-expanded', 'false');
                }
            });
        });
    });
</script>
