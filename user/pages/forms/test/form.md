---
title: Ajax Test-Form
form:
  name: ajax-test-form
  action: '/forms/test'
  template: form-messages
  template_format: json
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
      fileprefix: test-
      dateformat: Ymd-His-u
      extension: txt
      body: "{% include 'forms/data.txt.twig' %}"
    email:
      from: '{{ config.plugins.email.from }}'
      reply_to: '{{ form.value.email }}'
      bcc: '{{ form.value.email }}'
      to: '{{ config.plugins.email.to }}'
    message: 'Thank you for your submission!'
    reset: true
---

<div id="form-result"></div>
