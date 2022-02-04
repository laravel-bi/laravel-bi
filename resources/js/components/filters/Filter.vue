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
            initialValue: null,
            internalValue: null,
            confirmedValue: null,
            active: false
        };
    },
    mounted() {
        this.setInitialValue(this.defaultValue());
        this.setInternalValue(this.initialValue);
        this.setConfirmedValue(this.initialValue);
    },
    computed: {
        confirmedOrInitialValue: function() {
            return this.confirmedValue || this.initialValue;
        }
    },
    methods: {
        setInitialValue: function(value) {
            this.initialValue = JSON.parse(JSON.stringify(value));
        },
        setInternalValue: function(value) {
            this.internalValue = JSON.parse(JSON.stringify(value));
        },
        setConfirmedValue: function(value) {
            this.confirmedValue = JSON.parse(JSON.stringify(value));
        },
        emitValue: function() {
            this.$emit("input", this.confirmedValue);
        },
        reset: function() {
            this.setInternalValue(this.initialValue);
            this.setConfirmedValue(this.initialValue);
            this.active = false;
            this.emitValue();
        },
        apply: function() {
            this.setConfirmedValue(this.internalValue);
            this.active = false;
            this.emitValue();
        },
        close: function() {
            this.setInternalValue(this.confirmedOrInitialValue);
            this.active = false;
        },
        defaultValue() {
            return this.filterConfig.defaultValue || this.emptyValue();
        },
        emptyValue() {
            return null;
        },
        clickOutside() {
            if(this.active) this.close();
        }
    },
    directives: {
        "click-outside": vueClickOutside
    }
};
</script>