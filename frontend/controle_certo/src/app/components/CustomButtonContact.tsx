import { useState } from "react";
import { Button } from "react-bootstrap";
import CustomModalContact from "./CustomModalContact";

type CustomButtonProps = {
  className?: string;
  text?: string;
  variant: string;
  disable: boolean;
  setDisable: any;
};

const CustomButton: React.FC<CustomButtonProps> = ({ className, text, variant, setDisable, disable }) => {
  const [showModal, setShowModal] = useState(false);
  const [title, setTitle] = useState("");

  const handleShowModal = () => {
    if (className == "custom-button-save") {
      setTitle("Criar novo contato");
    } else {
      setTitle("Alterar contato");
    }
    setShowModal(true);
    setDisable(true);
  };

  const handleHideModal = () => {
    setShowModal(false);
    setDisable(false);
  };

  return (
    <>
      <Button className={className} variant={variant} onClick={handleShowModal} disabled={disable}>
        {text}
      </Button>
      <CustomModalContact show={showModal} onHide={handleHideModal} title={title} />
    </>
  );
};

export default CustomButton;
