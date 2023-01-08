import React from 'react'

const InputRadio = ({name, onChange, checked, children}) => {
  return (
    <div>
    <input type="radio" name={name} checked={checked} onChange={onChange} />
    <label htmlFor="lessThanFive">{children}</label>
  </div>
  )
}

export default InputRadio