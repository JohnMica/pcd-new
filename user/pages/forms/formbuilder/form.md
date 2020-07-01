---
title: 'Create a Submission'
forms:
  formbuilder:
    action: '/forms/formbuilder'
    fields:
      name:
        type: text
      email:
        type: email
      organisation:
        type: text
      project_name:
        type: text
      project_url:
        type: text
      project_logo_url:
        type: text
      project_category:
        type: text
      project_sector:
        type: text
      project_country:
        type: text
      project_languages:
        type: text
      project_type:
        type: text
      project_licence:
        type: text
      project_category:
        type: text
      project_sector:
        type: text
      project_description:
        type: textarea
      project_developers_name:
        type: text
      project_developers_website:
        type: text
      project_developers_logo_url:
        type: text
      project_developers_categ:
        type: text
      project_maintainers:
        type: text
      project_maintainers_name:
        type: text
      project_maintainers_website:
        type: text
      project_maintainers_logo_url:
        type: text
      project_maintainers_categ:
        type: text
      project_users_name:
        type: text
      project_users_website:
        type: text
      project_users_logo_url:
        type: text
      project_users_category:
        type: text
      project_users_location_longitude:
        type: text
      project_users_location_latitude:
        type: text
    buttons:
      submit:
        type: submit
        value: 'Send Form'
    process:
      save:
        fileprefix: created-entry-
        dateformat: Ymd-His-u
        extension: txt
        body: "{% include 'forms/data.txt.twig' %}"
      email:
        from: '{{ config.plugins.email.from }}'
        reply_to: '{{ form.value.email }}'
        bcc: '{{ form.value.email }}'
        to: '{{ config.plugins.email.to }}'
      reset: true
in_main_menu: false
in_footer_menu: false
cache_enable: false
---
