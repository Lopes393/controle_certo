import { Modal, Button } from "react-bootstrap";
import CustomInput from "./CustomInput";

type ModalProps = {
  show: boolean;
  title: string;
  onHide: () => void;
};

const CustomModal: React.FC<ModalProps> = ({ show, title, onHide }) => {
  return (
    <Modal show={show} onHide={onHide} className="custom-modal">
      <Modal.Header closeButton>
        <Modal.Title>{title}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <CustomInput placeholder="Nome" className="input-modal" />
        <CustomInput placeholder="CPF" className="input-modal" />
        <CustomInput placeholder="Tipo" className="input-modal" />
        <CustomInput placeholder="Descrição" className="input-modal" />
      </Modal.Body>
      <div className="modal-footer">
        <button className="btn btn-outline-close" type="button" onClick={onHide}>
          Fechar
        </button>
        <button className="btn btn-outline-success" type="button" onClick={onHide}>
          Salvar
        </button>
      </div>
    </Modal>
  );
};

export default CustomModal;
