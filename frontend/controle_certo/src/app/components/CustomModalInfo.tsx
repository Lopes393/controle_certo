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

const CustomModalInfo: React.FC<ModalProps> = ({ show, onHide, onSubmit, data, title }) => {
  const [payload, setPayload] = useState(data);

  const onChangeNome = (event: any) => {
    setPayload({ ...payload, name: event.target.value });
  };

  const onChangeCpf = (event: any) => {
    setPayload({ ...payload, cpf: event.target.value });
  };
  return (
    <Modal show={show} onHide={onHide} className="custom-modal">
      <Modal.Header closeButton>
        <Modal.Title>{title}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <CustomInput placeholder="Nome" className="input-modal" value={payload?.name} onChange={onChangeNome} />
        <CustomInput placeholder="CPF" className="input-modal" value={payload?.cpf} onChange={onChangeCpf} />
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

export default CustomModalInfo;
