import PostsService from '../services/PostsService';

export default {
  init() {
    // JavaScript to be fired on all pages
    // will be moved to archive section
    const loadMore = $('.posts__list__item__button--loadmore');
    if(loadMore.length) {
      loadMore.on('click touch', function(e){
        e.preventDefault();
        // const data = prepareData();
        PostsService.getPostsRequest();
      })
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
