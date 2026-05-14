<x-filament-panels::page>
    <div class="grid gap-6 lg:grid-cols-[1fr_0.8fr]">
        <x-filament::section>
            <x-slot name="heading">
                Assistant workspace
            </x-slot>

            <x-slot name="description">
                Prototype flow for planning itineraries before we wire in the Laravel AI SDK.
            </x-slot>

            <div class="space-y-5">
                <div class="rounded-lg border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/5">
                    <p class="text-sm font-semibold text-primary-600 dark:text-primary-400">Example admin prompt</p>
                    <p class="mt-3 text-lg font-medium text-gray-950 dark:text-white">
                        Create a 10-day Japan journey for 2 travelers, budget 4,500 EUR, focus on culture, food and calm boutique hotels.
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-lg border border-gray-200 p-4 dark:border-white/10">
                        <p class="text-sm font-semibold">1. Understand</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Summarize customer intent, budget, dates and constraints.</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 p-4 dark:border-white/10">
                        <p class="text-sm font-semibold">2. Draft</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Create route, day plan, services and offer text.</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 p-4 dark:border-white/10">
                        <p class="text-sm font-semibold">3. Save</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Store the itinerary and attach customer documents.</p>
                    </div>
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Next tools
            </x-slot>

            <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-200">
                <li>Search destination knowledge</li>
                <li>Create itinerary draft</li>
                <li>Draft proposal email</li>
                <li>Prepare PDF offer</li>
                <li>Search flights via booking API</li>
            </ul>
        </x-filament::section>
    </div>
</x-filament-panels::page>
