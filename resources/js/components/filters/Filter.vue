<script>

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
        this.internalValue = this.value;
    },
    watch: {
        active: function(newValue) {
            if(newValue) {
                this.$emit('activated', this.filterConfig.key);
            }
        }
    },
    methods: {
        reset() {
            this.internalValue = null;
            this.active = false;
            this.$emit("input", this.internalValue);
        },
        apply() {
            this.active = false;
            this.$emit("input", this.internalValue);
        },
        close() {
            this.active = false;
        }
    }
};
</script>