---
title: 'Create a Submission'
in_main_menu: true
in_footer_menu: true
cache_enable: false
forms:
  formbuilder:
    action: '/forms/formbuilder'
    fields:
      - name: sendername
        type: text
      - name: emailadress
        type: email
      - name: organisation
        type: text
      - name: project_name
        type: text
      - name: project_url
        type: text
      - name: project_logo_url
        type: text
      - name: project_category
        type: text
      - name: project_sector
        type: text
      - name: project_country
        type: text
      - name: project_languages
        type: text
      - name: project_type
        type: text
      - name: project_licence
        type: text
      - name: project_category
        type: text
      - name: project_sector
        type: text
      - name: project_description
        type: textarea
      - name: project_developers_name
        type: array
        validate:
          type: array
      - name: project_developers_website
        type: array
        validate:
          type: array
      - name: project_developers_logo_url
        type: array
        validate:
          type: array
      - name: project_developers_categ
        type: array
        validate:
          type: array
      - name: project_maintainers
        type: array
        validate:
          type: array
      - name: project_maintainers_name
        type: array
        validate:
          type: array
      - name: project_maintainers_website
        type: array
        validate:
          type: array
      - name: project_maintainers_logo_url
        type: array
        validate:
          type: array
      - name: project_maintainers_categ
        type: array
        validate:
          type: array
      - name: project_users_name
        type: array
        validate:
          type: array
      - name: project_users_website
        type: array
        validate:
          type: array
      - name: project_users_logo_url
        type: array
        validate:
          type: array
      - name: project_users_category
        type: array
        validate:
          type: array
      - name: project_users_location_longitude
        type: array
        validate:
          type: array
      - name: project_users_location_latitude
        type: array
        validate:
          type: array
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
  join-form:
    # refresh_prevention: true
    fields:
      honeypot:
        type: honeypot
      name:
        type: text
        label: 'Your name'
        validate:
          required: true
      email:
        label: 'Your email'
        type: email
        validate:
          required: true
      upload_file:
        label: 'Upload your entry.json file'
        type: file
        multiple: false
        limit: 1
        destination: 'user/data/files'
        accept:
          - '.json'
    buttons:
      submit:
        type: submit
        value: Submit
    process:
      save:
        fileprefix: uploaded-files-
        dateformat: Ymd-His-u
        extension: txt
        operation: create
        body: "{% include 'forms/data.txt.twig' %}"
      email:
        body: '{% include "forms/data.html.twig" %}'
        attachments:
          - upload-file
      message: 'Thank you for your email'
      reset: true
---

Use the appropriate method from below to create a new entry in the Database
