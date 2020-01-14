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
        this.setInternalValue(this.initialOrDefaultValue);
    },
    computed: {
        initialOrDefaultValue: function() {
            return JSON.parse(JSON.stringify(this.initialValue || this.defaultValue()));
        },
        confirmedOrDefaultValue: function() {
            return JSON.parse(JSON.stringify(this.confirmedValue || this.initialOrDefaultValue));
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
            this.$emit("input", JSON.parse(JSON.stringify(this.confirmedValue)));
        },
        reset: function() {
            this.setInternalValue(this.initialOrDefaultValue);
            this.setConfirmedValue(this.initialOrDefaultValue);
            this.active = false;
            this.emitValue();
        },
        apply: function() {
            this.setConfirmedValue(this.internalValue);
            this.active = false;
            this.emitValue();
        },
        close: function() {
            this.setInternalValue(this.confirmedOrDefaultValue);
            this.active = false;
        },
        defaultValue() {
            return null;
        },
    },
    directives: {
        "click-outside": vueClickOutside
    }
};
</script>