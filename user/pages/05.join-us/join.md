---
title: 'Submit Project'
in_main_menu: true
in_footer_menu: true
github_content: "Please raise an issue on the database repository with your comments or inclusions and we will check and update the files.\r\nTechnical users can follow the steps below to submit."
github_howto: "1. Fork the project on <a href='https://github.com/OpenUK/publiccode.directory' target='_blank' rel='noopener'>Github</a>\r\n2. Create a database metadata entry file - we call these entry.json, you may choose your own name\r\n3. Add your entry json file to our repo (via PR), to your own repository or anywhere that can be accessed via the internet\r\n4. Add a link to the **database.index.json** file pointing to your entry\r\n5. Make a pull request with the updated **database.index.json** file\r\n\r\nWhen accepted, you should see your entry in the directory"
cache_enable: false
forms:
  join-form:
    inline_errors: true
    fields:
      - name: name
        type: text
        label: 'Your name'
        validate:
          required: true
      - name: email
        label: 'Your email'
        type: email
        validate:
          required: true
      - name: upload-file
        label: 'Upload your entry.json file'
        type: file
        multiple: false
        limit: 10
        destination: 'user/data/files'
        accept:
          - .json
          - .yaml
          - .yml
    buttons:
      - type: submit
        value: Submit
    process:
      - reset: true
      - email:
          body: '{% include "forms/data.html.twig" %}'
          attachments:
            - upload-file
      - save:
          fileprefix: uploaded-files-
          dateformat: Ymd-His-u
          extension: txt
          operation: create
          body: '{% include "forms/data.txt.twig" %}'
      - message: 'Thank you for your email'
      - display: thankyou
---

Use the appropriate method from below to create a new entry in the Database
