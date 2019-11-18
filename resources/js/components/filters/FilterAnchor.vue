<template>

    <a
        href="#"
        class="outline-none text-sm p-4 py-2 border-r-1 cursor-pointer"
        :class="{
                'bg-gray-500 text-white' : active,
                'hover:bg-gray-100' : !active,
            }"
        @click.prevent="$emit('activated')"
    >
        <slot></slot>
    </a>

</template>

<script>
export default {
    props: {
        active: Boolean
    }
};
</script>