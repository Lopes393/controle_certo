type CustomInputProps = {
  placeholder?: string;
  value?: string;
  className: string;
  onChange?: any;
};

const CustomInput: React.FC<CustomInputProps> = ({ placeholder, value, className, onChange }) => {
  return <input type="text" className={className} placeholder={placeholder} onChange={onChange} value={value} />;
};

export default CustomInput;
