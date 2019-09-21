<template>

    <a
        href="#"
        class="outline-none text-14 block p-14"
        :class="{
                'bg-gray-500 text-white' : active,
                'hover:bg-gray-200 hover:text-gray-600' : !active,
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