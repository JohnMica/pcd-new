import * as rules from 'vee-validate/dist/rules'
import { messages } from 'vee-validate/dist/locale/en.json'
import { extend } from 'vee-validate'

Object.keys(rules).forEach((rule) => {
  extend(rule, {
    ...rules[rule], // copies rule configuration
    message: messages[rule], // assign message
  })
})
let urlPattern = new RegExp(
  /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,}))\.?)(?::\d{2,5})?(?:[/?#]\S*)?$/i
)

let latlongPatt = new RegExp(
  '^' + // No leading content.
  '[-+]?' + // Optional sign.
  '(?:[0-9]{0,30}\\.)?' + // Optionally 0-30 decimal digits of mantissa.
  '[0-9]{1,30}' + // 1-30 decimal digits of integer or fraction.
  '(?:[Ee][-+]?[1-2]?[0-9])?' + // Optional exponent 0-29 for scientific notation.
    '$' // No trailing content.
)

extend('name', {
  validate(value, { length }) {
    return value.length >= length
  },
  params: ['length'],
  message: (fieldName, placholders) => {
    return `The ${fieldName} field must have more then ${placholders.length} alpha numeric characters`
  },
})

extend('url_string', (value) => {
  if (urlPattern.test(value)) {
    return true
  }
  return 'The {_field_} field is not a valid URL'
})

extend('latlong', (value) => {
  if (latlongPatt.test(value)) {
    return true
  }
  return 'The {_field_} field is not a valid Latitude / Longitude'
})
extend('alpha_num', {
  validate(value, { length }) {
    return value.length >= length
  },
  params: ['length'],
  message: 'The {_field_} field must have at least {length} language',
})
extend('minmax', {
  validate(value, { min, max }) {
    return value.length >= min && value.length <= max
  },
  params: ['min', 'max'],
  message:
    'The {_field_} field must have at least {min} characters and {max} characters at most',
})
// extend('required', {
//   ...required,
//   message: 'This field is required',
// })

// extend('email', {
//   ...email,
//   message: 'This field must be a valid email',
// })
// extend('min', {
//   ...min,
//   message: 'This field must have more then 3 characters',
// })

// extend('confirmed', {
//   ...confirmed,
//   message: 'This field confirmation does not match',
// })

// extend('length', {
//   ...length,
//   message: 'This field must have 2 options',
// })
