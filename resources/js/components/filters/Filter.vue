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
            confirmedValue: null,
            active: false
        };
    },
    mounted() {
        this.internalValue = this.value ? JSON.parse(JSON.stringify(this.value)) : this.defaultValue();
        this.confirmedValue = this.value ? JSON.parse(JSON.stringify(this.value)) : this.defaultValue();
        this.$nextTick(() => {
            this.$emit("input", JSON.parse(JSON.stringify(this.internalValue)));
        });
        
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
            return this.filterConfig.defaultValue;
        },
        reset() {
            this.internalValue = this.defaultValue();
            this.confirmedValue = this.defaultValue();
            this.active = false;
            this.$emit("input", JSON.parse(JSON.stringify(this.internalValue)));
        },
        apply() {
            this.active = false;
            this.confirmedValue = JSON.parse(JSON.stringify(this.internalValue));
            this.$emit("input", JSON.parse(JSON.stringify(this.internalValue)));
        },
        close() {
            this.active = false;
            this.internalValue = JSON.parse(JSON.stringify(this.confirmedValue));
        }
    },
    directives: {
        "click-outside": vueClickOutside
    }
};
</script>