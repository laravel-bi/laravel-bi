<script>
import vueClickOutside from "vue-click-outside";

export default {
    props: {
        filterConfig: Object,
        dashboardKey: String,
        value: {}
    },
    data() {
        return {
            internalValue: null,
            confirmedValue: null,
            presetValue: null,
            active: false
        };
    },
    mounted() {
        this.$nextTick(() => {
            if (this.value) {
                this.presetValue = JSON.parse(JSON.stringify(this.value));
                this.internalValue = JSON.parse(JSON.stringify(this.value));
                this.confirmedValue = JSON.parse(JSON.stringify(this.value));
                this.$emit("input", this.getClonedValue());
            } else {
                this.internalValue = this.defaultValue();
            }
        });
    },
    watch: {
        active: function(newValue) {
            if (newValue) {
                this.$emit("activated", this.filterConfig.key);
            }
        }
        // value: function(newValue) {
        //     console.log("values has changed", newValue);
        // }
    },
    methods: {
        defaultValue() {
            return null;
        },
        reset() {
            if (this.presetValue) {
                this.internalValue = JSON.parse(
                    JSON.stringify(this.presetValue)
                );
                this.confirmedValue = JSON.parse(
                    JSON.stringify(this.presetValue)
                );
                this.$emit("input", this.getClonedValue());
            } else {
                this.confirmedValue = null;
                this.internalValue = this.defaultValue();
                this.$emit("input", null);
            }
            this.active = false;
        },
        apply() {
            this.active = false;
            this.confirmedValue = this.getClonedValue();
            this.$emit("input", this.getClonedValue());
        },
        close() {
            this.active = false;
            this.internalValue = JSON.parse(
                JSON.stringify(this.confirmedValue)
            );
        },
        getClonedValue() {
            return JSON.parse(JSON.stringify(this.internalValue));
        }
    },
    directives: {
        "click-outside": vueClickOutside
    }
};
</script>