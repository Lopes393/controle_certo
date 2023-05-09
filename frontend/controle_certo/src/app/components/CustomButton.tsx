import { useState } from "react";
import { Button } from "react-bootstrap";
import CustomModal from "./CustomModal";

type CustomButtonProps = {
  className?: string;
  text?: string;
  variant: string;
};

const CustomButton: React.FC<CustomButtonProps> = ({ className, text, variant }) => {
  const [showModal, setShowModal] = useState(false);
  const [title, setTitle] = useState("");

  const handleShowModal = () => {
    if (className == "custom-button-save") {
      setTitle("Criar novo contato");
    } else {
      setTitle("Alterar contato");
    }
    setShowModal(true);
  };

  const handleHideModal = () => {
    setShowModal(false);
  };

  return (
    <>
      <Button className={className} variant={variant} onClick={handleShowModal} disabled={showModal}>
        {text}
      </Button>
      <CustomModal show={showModal} onHide={handleHideModal} title={title} />
    </>
  );
};

export default CustomButton;
