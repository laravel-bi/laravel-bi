<template>
    <div class="absolute top-0 right-0 bg-white p-8 shadow z-10 w-filter-dropdown" style="margin-top: 5rem;">
        <div class="flex mb-2">
            <slot></slot>
        </div>

        <div class="mt-6">
            <button
                @click="$emit('close')"
                class="bg-gray-200 hover:bg-gray-300 text-14 p-8 py-4 text-gray-800 rounded mr-4 focus:outline-none"
            >Close</button>
            <button
                @click="$emit('reset')"
                class="bg-gray-200 hover:bg-gray-300 text-14 p-8 py-4 text-gray-800 rounded mr-4 focus:outline-none"
            >Reset</button>
            <button
                @click="$emit('apply')"
                class="bg-btn hover:bg-btn-h text-14 p-8 py-4 text-white rounded focus:outline-none float-right"
            >Apply</button>
        </div>
    </div>
</template>