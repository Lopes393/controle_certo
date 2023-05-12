import { Modal, Button } from "react-bootstrap";
import CustomInput from "./CustomInput";
import { useState } from "react";

type ModalProps = {
  show: boolean;
  onHide: () => void;
  onSubmit: (payload: any) => void;
  data?: any;
  title: string;
};

const CustomModal: React.FC<ModalProps> = ({ show, onHide, onSubmit, data, title }) => {
  const [payload, setPayload] = useState(data);

  const onChangeTipo = (event: any) => {
    setPayload({ ...payload, type: event.target.value });
  };

  const onChangeDescricao = (event: any) => {
    setPayload({ ...payload, description: event.target.value });
  };

  return (
    <Modal show={show} onHide={onHide} className="custom-modal">
      <Modal.Header closeButton>
        <Modal.Title>{title}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <CustomInput placeholder="Tipo" className="input-modal" value={payload?.type} onChange={onChangeTipo} />
        <CustomInput
          placeholder="Descrição"
          className="input-modal"
          value={payload?.description}
          onChange={onChangeDescricao}
        />
      </Modal.Body>
      <div className="modal-footer">
        <button className="btn btn-outline-close" type="button" onClick={onHide}>
          Fechar
        </button>
        <button className="btn btn-outline-success" type="button" onClick={() => onSubmit(payload)}>
          Salvar
        </button>
      </div>
    </Modal>
  );
};

export default CustomModal;
