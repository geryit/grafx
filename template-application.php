<?php
/* Template Name: Application */
get_header(); ?>
<div id="wrap">
  <div class="headItemsWrap"
       style="background-image: url(<?= get_field('page_header_image') ?>)">
    <div class="container">

      <ul class="headItems headItems--about">

        <li class="headItems__item">
          <span class="headItems__link light active">Application Form</span>
        </li>
      </ul>

    </div>

  </div>


  <div class="application">
    <div class="container">
      <div class="application__inner">

        <? //=do_shortcode('[gravityform id="2" title="false" description="false"]'); ?>
        <? //=do_shortcode('[gravityform id="8" title="false" description="false"]'); ?>


        <form name="application__form" class="application__form"
              ng-submit="submitApp()" novalidate
        >

          <div class="application__section" ng-repeat="section in sections">
            <h4 class="application__head">{{section.title}}</h4>
            <div class="application__note">Fields marked with an * is not required</div>
            <div class="application__error">{{section.errorMsg}}</div>

            <ul class="application__fields">
              <li class="application__field" ng-repeat="field in section.fields">
                <div class="application__items">
                  <input type="{{field.type}}"
                         class="application__input"
                         placeholder="{{field.placeholder}}"
                         ng-model="user.title"
                         required
                  >
                  <label class="application__label">{{field.label}}</label>
                </div>

              </li>
            </ul>
          </div>

          <button type="submit">Submit</button>

        </form>
      </div>
      <div class="pluses">
        <div class="container">
          <div class="pluses__inner"></div>
        </div>
      </div>
    </div>
  </div>


</div>
<?php get_footer(); ?>
