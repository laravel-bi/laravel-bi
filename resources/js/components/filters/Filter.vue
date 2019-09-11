<script>
import vueClickOutside from "vue-click-outside";

export default {
    props: {
        filterConfig: Object,
        dashboardKey: String
    },
    data() {
        return {
            internalValue: null,
            active: false
        };
    },
    mounted() {
        this.internalValue = this.value ? JSON.parse(JSON.stringify(this.value)) : this.defaultValue();
    },
    watch: {
        active: function(newValue) {
            if(newValue) {
                this.$emit('activated', this.filterConfig.key);
            }
        }
    },
    methods: {
        defaultValue() {
            return null
        },
        reset() {
            this.internalValue = null;
            this.active = false;
            this.$emit("input", JSON.parse(JSON.stringify(this.internalValue)));
        },
        apply() {
            this.active = false;
            this.$emit("input", JSON.parse(JSON.stringify(this.internalValue)));
        },
        close() {
            this.active = false;
        }
    },
    directives: {
        "click-outside": vueClickOutside
    }
};
</script>