{{-- if current user is admin --}}
<pmst-paper style="width: 100%; padding: 24px;
   margin-bottom: 24px;
   " elevation="1">
   <pmst-col>
      <pmst-row>
         <p style="
            font-size: 24px;
            font-weight: 500;
            line-height: 21px;
            text-align: center;
            color: #1e6dfb;
            "
            class="price">{{ _e('Premium', 'premast') }}</p>
      </pmst-row>

      <pmst-row>
         <a href="{{ 'https://app.premast.com/template/' . $product->get_slug() }}" target="_blank"
            style="width: 100%;" id="somdn-form-submit-button">
            <pmst-button>Download Now</pmst-button>
         </a>
      </pmst-row>

      <pmst-row
                style="
            display: flex;
            justify-content: center;
            ">
         <img src="{{ get_theme_file_uri() . '/dist/images/2checkout-3.png' }}" alt="2Checkout">
      </pmst-row>
   </pmst-col>

</pmst-paper>







<style>
   .custom-summary .free button#somdn-form-submit-button:after {
      content: "Download For Free";
      font-weight: 500;
      font-size: 18px;
      line-height: 21px;
   }

   .download-product .free button#somdn-form-submit-button {
      font-size: 0;
      outline: none;

   }

   .custom-summary .free button#somdn-form-submit-button:after {
      display: block;
   }

   .custom-summary .free button#somdn-form-submit-button.loading:after {
      position: relative;
      top: auto;
      content: "\e01c" !important;
      right: auto;
   }

   .custom-summary .bottom-summary {
      display: flex;
      justify-content: center;
      font-size: 16px;
      font-weight: 400;
      height: 100%;
   }

   .custom-summary .bottom-summary .btn-limit {
      box-sizing: border-box;
      font-weight: 400;
      font-size: 16px;
      line-height: 21px;
      text-align: center;
      text-decoration: none;
      text-transform: uppercase;
      transition: all 0.3s ease 0s;
   }
</style>
