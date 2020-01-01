import Search from "@/plugins/search";

const SearchMixin = {
  mounted() {
    Search.onSearch.$on("search", term => {
      this.search(term);
    });
  }
};

export default SearchMixin;
