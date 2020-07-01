---
title: 'Submit Project'
in_main_menu: true
in_footer_menu: true
cache_enable: false

github_content: "Please raise an issue on the database repository with your comments or inclusions and we will check and update the files.\r\nTechnical users can follow the steps below to submit."
github_howto: "1. Fork the project on <a href='https://github.com/OpenUK/publiccode.directory' target='_blank' rel='noopener'>Github</a>\r\n2. Create a database metadata entry file - we call these entry.json, you may choose your own name\r\n3. Add your entry json file to our repo (via PR), to your own repository or anywhere that can be accessed via the internet\r\n4. Add a link to the **database.index.json** file pointing to your entry\r\n5. Make a pull request with the updated **database.index.json** file\r\n\r\nWhen accepted, you should see your entry in the directory"

forms:
  formbuilder:
    # action: '/forms/formbuilder'
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
