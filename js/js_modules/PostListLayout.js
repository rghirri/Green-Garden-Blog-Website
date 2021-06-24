class PostListLayout {
  constructor() {
    // this.add_article_btn = document.querySelector(".add_article_btn");
    this.post_list_layout = document.querySelector(".post_list_layout");
    this.home_link = document.querySelector(".home_link");

    this.home_link.addEventListener("click", toggleLayout());
  }

  toggleLayout() {
    this.post_list_layout.classList.toggle("order-2 order-md-1");
  }
}

export default PostListLayout;
