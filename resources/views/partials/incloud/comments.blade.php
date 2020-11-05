<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;
if ( ! comments_open() ) {
	return;
}
?>
<div id="reviews" class="woocommerce-Reviews col-12 mt-5 product-infomation p-0">
	<div id="comments">
		<h3 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review', '%1$s reviews', $count, 'woocommerce' ) ), esc_html( $count ) );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			}
			?>
		</h3>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">

				<?php
        $commenter = wp_get_current_commenter();
        global $current_user;
        wp_get_current_user();
				$comment_form = array(
					'title_reply_before'  => '<div class="avatar-comments">' . get_avatar( $current_user->ID, 64 ) . '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span></div>',
					'comment_notes_after' => '',
					'fields'              => array(
						'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
									'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label> ' .
									'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></p>',
					),
					'label_submit'        => __( 'Submit', 'woocommerce' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);
				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}
				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select> <span class="rate-text"> ' . esc_html__( 'rate this item!', 'woocommerce' ) . ' </span></div>';
				}
				$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="25" rows="4" placeholder=" '.__("write your comment.....", "premast") .'" aria-required="true"></textarea></p>';
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>



<?php
global $post;
$recent_comments = get_comments( array(
    'status'      => 'approve', // we only want approved comments.
    'post_status' => 'publish', // limit to published comments.
    'post_id' => $post->ID,
    'callback' => 'woocommerce_comments',
    'parent' => 0,
) );

$counter_lg = get_comments( array(
  'post_id' => $post->ID,
  'parent' => 0,
  'count' => true
));

?>
<?php if($recent_comments) : ?>
    <?php
      foreach((array) $recent_comments as $comment) :
      $time = date_i18n('d M Y', strtotime($comment->comment_date));
      $rating = get_comment_meta($comment->comment_ID, 'rating', true);
    ?>
    <div class="commentlist lg-comments">
      <div id="comment-<?= $comment->comment_ID; ?>">
        <article id="div-comment-<?= $comment->comment_ID; ?>">
          <div class="media authcomment mt-3">
            <?php echo get_avatar($comment->comment_author_email, 48); ?>
            <div class="media-body">
              <div class="d-flex mb-3">{!! wc_get_rating_html($rating, '5') !!}</div>
              <?php if ($comment->comment_approved == '0') : ?>
                  <p>Your comment is awaiting approval</p>
              <?php endif; ?>
              <h5 class="mt-0"><?= $comment->comment_author; ?> <time><small><?= $time ?></small></time></h5>
              <p class="mb-3"><?= $comment->comment_content; ?></p>
                <div class="d-flex">
                  {!! get_comment_likes_button( $comment->comment_ID ) !!}
                  <div class="reply">
                    <?php
                    $max_depth = get_option('thread_comments_depth');
                    $default = array(
                        'add_below'  => 'comment',
                        'respond_id' => 'respond',
                        'reply_text' => __('Reply'),
                        'login_text' => __('Log in to Reply'),
                        'depth'      => 1,
                        'before'     => '',
                        'after'      => '',
                        'max_depth'  => $max_depth
                        );
                    comment_reply_link($default, $comment->comment_ID, $post->ID); ?>
                  </div>
                </div>
            </div>
          </div>
        </article>
      </div>
    </div>

    <?php
    $childcomments = get_comments(array(
      'post_id'   => $post->ID,
      'status'    => 'approve',
      'order'     => 'DESC',
      'parent'    => $comment->comment_ID,
    ));
    $counter_sm = get_comments( array(
      'post_id' => $post->ID,
      'parent' => $comment->comment_ID,
      'count' => true
    ));
    ?>
    <?php if($childcomments) : ?>
        <?php
          foreach((array) $childcomments as $comment) :
          $time = date_i18n('d M Y', strtotime($comment->comment_date));
          $rating = get_comment_meta($comment->comment_ID, 'rating', true);
        ?>
        <div class="commentlist ml-5 similar-comments">
          <div id="comment-<?= $comment->comment_ID; ?>">
            <article id="div-comment-<?= $comment->comment_ID; ?>">
              <div class="media authcomment mt-3">
                <?php echo get_avatar($comment->comment_author_email, 48); ?>
                <div class="media-body">
                  <div class="d-flex mb-3">{!! wc_get_rating_html($rating, '5') !!}</div>
                  <?php if ($comment->comment_approved == '0') : ?>
                      <p>Your comment is awaiting approval</p>
                  <?php endif; ?>
                  <h5 class="mt-0"><?= $comment->comment_author; ?> <time><small><?= $time ?></small></time></h5>
                  <p class="mb-3"><?= $comment->comment_content; ?></p>
                  {!! get_comment_likes_button( $comment->comment_ID ) !!}
                </div>
              </div>
            </article>
          </div>
        </div>

      <?php endforeach; ?>
    <?php endif; ?>
    @if($counter_sm  >= 3)
      <a href="#" id="loadMoreSimilar" class="related-loadMore">{{ _e('See all comments', 'premast') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
    @endif

  <?php endforeach; ?>
<?php endif; ?>

  @if ($counter_lg >= 3)
    <a href="#" id="loadMore" class="related-loadMore">{{ _e('See all comments', 'premast') }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
  @endif

	<div class="clear"></div>
</div>

<script>
  jQuery(function($) {
    $(document).ready(function(){
      $(".lg-comments").slice(0, 3).show();
      $("#loadMore").on("click", function(e){
        e.preventDefault();
        $(".lg-comments:hidden").slice(0, 3).slideDown();
        if($(".lg-comments:hidden").length == 0) {
          $("#loadMore").fadeOut("slow");
        }
      });

      $( "textarea#comment" ).keyup(function() {
        $("input#submit").addClass('active');
      });
    });
    $(document).ready(function(){
      $(".similar-comments").slice(0, 3).show();
      $("#loadMoreSimilar").on("click", function(e){
        e.preventDefault();
        $(".similar-comments:hidden").slice(0, 3).slideDown();
        if($(".similar-comments:hidden").length == 0) {
          $("#loadMoreSimilar").fadeOut("slow");
        }
      });
    });
  });
</script>


<style>
  div#reviews {
    border-top: 1px solid rgba(0, 0, 0, 0.25);
  }

  h3.woocommerce-Reviews-title {
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 18px;
    line-height: 27px;
    color: #282F39;
  }

  .woocommerce p.stars a {
    height: 18px !important;
    width: 18px !important;
    margin-top: 20px;
  }

  .woocommerce p.stars a::before {
    color: #646464;
    font-size: 18px;
  }

  .avatar-comments {
    display: none !important;
  }

  div#reviews #respond form {
    margin: 0 !important;
  }

  .woocommerce #reviews #comment {
    height: 48px !important;
  }

  p.comment-notes {
    display: none;
  }

  p.comment-form-author,
  p.comment-form-email {
    width: 47.5%;
    float: left;
    order: 1;
  }

  p.comment-form-author label,
  p.comment-form-email label {
    position: absolute;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.132987px;
    color: #646464;
    padding: 12px 20px;
  }

  p.comment-form-comment {
    width: 100%;
    order: 3;
    background: #FFFFFF !important;
    border: 1px solid #E3E3E3 !important;
    box-sizing: border-box !important;
    border-radius: 8px !important;
  }

  p.comment-form-cookies-consent {
    order: 4;
  }

  p.form-submit {
    order: 5;
    width: 100%;
  }

  .comment-form-rating {
    width: 100%;
  }

  p.comment-form-author input,
  p.comment-form-email input {
    background: #FFFFFF;
    border: 1px solid #E3E3E3 !important;
    box-sizing: border-box;
    border-radius: 8px !important;
    height: 40px !important;
  }

  p.comment-form-author {
    margin-right: 5% !important;
  }

  p.comment-form-cookies-consent,
  p.comment-form-cookies-consent label {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.04px;
    color: #646464;
    margin: 15px 0px;
  }

  #reviews .authcomment .media-body {
    background: #FFFFFF;
    border: 1px solid #E8E8E8;
    box-sizing: border-box;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
  }

  .woocommerce #review_form #respond .form-submit input#submit {
    width: 99px;
    height: 40px;
    background-color: #E8E8E8 !important;
    border-radius: 30px;
    float: left;
  }

  .woocommerce #review_form #respond p.form-submit {
    margin-bottom: 75px !important;
    margin-top: 20px;
  }

  #loadMore,
  #loadMoreSimilar {
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 19px;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #1E6DFB;
    border-radius: 4px;
    margin: 5px 0px;
    border: none;
    float: left;
    width: auto;
  }

  .woocommerce #review_form #respond form {
    display: flex;
    flex-flow: wrap;
  }

  .woocommerce #review_form #respond .form-submit input#submit.active {
    background-color: #1e6cfb !important;
  }
</style>
