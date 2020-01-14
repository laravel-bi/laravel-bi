<template>
    <div class="absolute bg-white p-2 shadow z-10 bi:filter-dropdown">
        <div class="flex mb-2">
            <slot></slot>
        </div>

        <div class="mt-6">
            <button
                @click.stop="$emit('close')"
                class="bg-gray-200 hover:bg-gray-300 text-sm p-2 py-1 text-gray-800 rounded mr-2 focus:outline-none"
            >Close</button>
            <button
                @click.stop="$emit('reset')"
                class="bg-gray-200 hover:bg-gray-300 text-sm p-2 py-1 text-gray-800 rounded focus:outline-none"
            >Reset</button>
            <button
                @click.stop="$emit('apply')"
                class="bg-gray-700 hover:bg-gray-800 text-sm p-2 py-1 text-white rounded focus:outline-none float-right"
            >Apply</button>
        </div>
    </div>
</template>