import Paginator from "@/plugins/paginate";

const PaginationMixin = {
  data: function() {
    return {
      links: {},
      meta: {}
    };
  },
  methods: {
    navigate: function(param) {
      this.getData(this.links[param]);
    },

    paginate: function(data) {
      this.links = data.links || null;
      this.meta = data.meta || null;
      return data.data || data;
    }
  },
  mounted() {
    Paginator.onPaginate.$on("paginate", params => {
      this.navigate(params);
    });

    Paginator.onPaginate.$on("jump-to", page => {
      this.getData(`${this.meta.path}?page=${page}`);
    });
  }
};

export default PaginationMixin;
