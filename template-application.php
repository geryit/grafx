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
    <div class="application__inner">


      <form name="application__form" class="application__form"
            ng-submit="submitApp()" novalidate
      >

<!--      <pre>-->
<!--      {{application__form.email | json}}-->
<!--      </pre>-->


        <div ng-repeat="section in sections"
             ng-init="parentIndex = $index"
             class="application__section application__section__{{$index}}"
             style="background-color: {{section.bg}}">
          <div class="container">
            <h4 class="application__head">{{section.title}}</h4>
            <div class="application__note">{{section.subTitle}}</div>
            <div
              class="application__error"
              ng-if="section.invalid"
            >
              {{section.errorMsg}}
            </div>


<!---->
<!--            <pre>-->
<!--      {{section | json}}-->
<!--      </pre>-->


            <ul class="application__fields">
              <li class="application__field"
                  ng-repeat="field in section.fields"
                  ng-init="index = $index"
                  ng-class="{'application__field--opts':field.type=='checkbox'}"
              >


                <div class="application__items">

                  <input
                    ng-if="field.type=='input' || field.type=='email'"
                    name="{{field.name}}"
                    ng-model="field.value"
                    type="{{field.type}}"
                    class="application__input"
                    id="field__{{parentIndex}}__{{index}}"
                    placeholder="{{field.placeholder}}"
                    ng-required="!field.notRequired"
                  >

                  {{$select}}
                  <ui-select
                    name="{{field.name}}"
                    my-ui-select
                    ng-if="field.type=='select'"
                    ng-model="country.selected"
                    theme="selectize"
                    required
                  >
                    <ui-select-match placeholder="{{field.placeholder}}">
                      {{$select.selected.name}}
                    </ui-select-match>
                    <ui-select-choices repeat="item in field.items | filter: $select.search">
                      <span ng-bind-html="item.name | highlight: $select.search"></span>
                    </ui-select-choices>
                  </ui-select>

                  <div
                    ng-if="field.type=='file'"
                    class="application__upload ng-invalid"
                    ng-class="{'ng-invalid':errFile.name}"
                  >
                    <input
                      ng-model="field.value"
                      type="hidden"
                    >
                    <input
                      ng-model="field.fName"
                      name="{{field.name}}"
                      type="text"
                      class="application__input application__upload__input"
                      placeholder="{{field.placeholder}}"
                      ng-class="{'ng-invalid':errFile.name}"
                      required
                      readonly
                    >


                    <button type="file"
                            ngf-select="uploadFiles($file, $invalidFiles, field)"
                            accept="application/pdf,application/msword"
                            ngf-max-size="1MB"
                            class="application__upload__btn"
                    >
                      BROWSE
                    </button>


                  </div>

                  <ul class="opts" ng-if="field.type=='checkbox'">
                    <li
                      ng-repeat="cItem in field.items"
                      ng-init="cIndex = $index"
                      class="opts__item"
                    >

                      <input id="opt__{{parentIndex}}__{{cIndex}}"
                             value="{{cItem.checked}}"
                             type="checkbox"
                             class="opts__cb"
                             ng-model="cItem.checked"
                             ng-change="countItems(field)"
                             name="{{field.name}}"
                      />
                      <label for="opt__{{parentIndex}}__{{cIndex}}" class="opts__label">
                        <span class="icon-check" claass="opts__icon"></span>
                        <span class="opts__txt">{{cItem.label}}</span>
                      </label>
                    </li>
                  </ul>

                  <label
                    ng-if="field.label"
                    class="application__label"
                    for="field__{{parentIndex}}__{{index}}"
                  >{{field.label}} {{!field.notRequired ? '(*)' : ''}}</label>


                </div>

              </li>
            </ul>
          </div>
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
<?php get_footer(); ?>
