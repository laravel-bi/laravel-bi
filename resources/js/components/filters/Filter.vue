<script>
import vueClickOutside from "vue-click-outside";

export default {
    props: {
        filterConfig: Object,
        dashboardKey: String,
        value: {}
    },
    data() {
        //console.log('data');
        return {
            initialValue: null, 
            internalValue: null,
            confirmedValue: null,
            active: false
        };
    },
    mounted() {
        //console.log('mounted');
        this.setInternalValue(this.initialOrDefaultValue);
        // this.setDefaultValue(this.value);
        // this.$nextTick(() => {

        // });
    },
    watch: {
        // value: function(oldVal, newVal) {
        //     //console.log('watch.value', oldVal, newVal);
        //     if(this.value) {
        //         this.setInternalValue(this.value);
        //         this.setInitialValue(this.value);
        //     }
        // }
        // active: function(newValue) {
        //     if (newValue) {
        //         this.$emit("activated", this.filterConfig.key);
        //     }
        // }
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
            //console.log('setInitialValue', value);
            this.initialValue = JSON.parse(JSON.stringify(value));
        },
        setInternalValue: function(value) {
            //console.log('setInternalValue', value);
            this.internalValue = JSON.parse(JSON.stringify(value));
        },
        setConfirmedValue: function(value) {
            //console.log('setConfirmedValue', value);
            this.confirmedValue = JSON.parse(JSON.stringify(value));
        },
        emitValue: function() {
            this.$emit("input", JSON.parse(JSON.stringify(this.confirmedValue)));
        },
        reset: function() {
            //console.log('reset');
            this.setInternalValue(this.initialOrDefaultValue);
            this.setConfirmedValue(this.initialOrDefaultValue);
            this.active = false;
            this.emitValue();
        },
        apply: function() {
            //console.log('apply');
            this.setConfirmedValue(this.internalValue);
            this.active = false;
            this.emitValue();
        },
        close: function() {
            console.log('close');
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