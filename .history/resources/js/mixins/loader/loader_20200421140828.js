const LoadingMixin = {
    data: function() {
        return {
            loading: false
        };
    },
    mounted() {
        window.Pace.on("start", function() {
            Event.$emit("loading", true);
        });

        window.Pace.on("stop", function() {
            Event.$emit("loading", false);
        });

        window.Pace.on("done", function() {
            Event.$emit("loading", false);
        });

        window.Pace.on("hide", function() {
            Event.$emit("loading", false);
        });

        window.Pace.on("restart", function() {
            Event.$emit("loading", true);
        });

        Event.$on("loading", state => {
            this.loading = state;
        });
    }
};
export default LoadingMixin;