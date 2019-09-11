<template>
    <div class="absolute top-0 right-0 bg-white mt-8 p-4 shadow z-10">
        <div class="mb-2 flex">
            <slot></slot>
        </div>

        <div class="flex">
            <button
                @click="$emit('close')"
                class="bg-gray-200 hover:bg-gray-300 p-4 py-2 text-gray-800 rounded mr-2 float-right focus:outline-none"
            >Close</button>
            <button
                @click="$emit('reset')"
                class="bg-gray-200 hover:bg-gray-300 p-4 py-2 text-gray-800 rounded mr-2 focus:outline-none"
            >Reset</button>
            <button
                @click="$emit('apply')"
                class="bg-primary hover:bg-primary-600 p-4 py-2 text-white rounded focus:outline-none"
            >Apply</button>
        </div>
    </div>
</template>