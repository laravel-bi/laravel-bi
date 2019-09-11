<template>

    <a
        href="#"
        class="p-2 outline-none"
        :class="{
                'bg-gray-500 text-white' : active,
                'hover:bg-gray-200 hover:text-gray-600' : !active,
            }"
        @click="$emit('activated')"
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