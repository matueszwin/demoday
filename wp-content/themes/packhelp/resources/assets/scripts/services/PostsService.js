import axios from 'axios';
import ErrorHandler from '../helpers/errorHandler';
import queryString from 'qs';

class PostsService {
  static getPostsRequest() {
    const page = $('.posts_list__item__button--loadmore').data('page')
    console.log(page)
    const data = {page, action: 'stella_ajax_get_posts'}
    const ajaxObject = window.ajaxObject || false;
    // the ajax object need for admin-ajax.php
    if($('.posts-list').length > 0) {
      $('.spinner-holder').addClass('isLoading');
    }
    axios.post(ajaxObject.ajax_url, queryString.stringify(data)).then(response => {
      // success, we call the success handler
      console.log(response)
    PostsService.getPostsSuccess(response.data);

  }).catch(e => {
      ErrorHandler.handleError(e);
  }).finally(() => {
      // disable loader state
      if($('.posts_list').length > 0) {
      $('.spinner-holder').removeClass('isLoading');
    }
  });
  }

  static getPostsSuccess(data) {
    if($('.posts_list').length > 0 ) {
      $('.posts_list').append(data.html);
      $('.posts_list__item__button--loadmore').data('page',data.page);
      $('.posts_list__item__button--loadmore').data('displayed',data.page);
    }
    if( data.page >= data.maxPage ) {
      $('.posts_list__item__button--loadmore').addClass('d-none');
    }
  }

}

export default PostsService;