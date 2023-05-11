import { Modal, Button } from "react-bootstrap";
import CustomInput from "./CustomInput";

type ModalProps = {
  show: boolean;
  title: string;
  onHide: () => void;
  onSubmit: (payload: any) => void;
  data?: any;
};

let payload: any = {};

const onChangeNome = (event: any) => {
  console.log(event.target.value);
  payload = { ...payload, nome: event.target.value };
};

const onChangeCpf = (event: any) => {
  console.log(event.target.value);
  payload = { ...payload, cpf: event.target.value };
};

const CustomModalInfo: React.FC<ModalProps> = ({ show, title, onHide, onSubmit, data }) => {
  return (
    <Modal show={show} onHide={onHide} className="custom-modal">
      <Modal.Header closeButton>
        <Modal.Title>{title}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <CustomInput placeholder="Nome" className="input-modal" value={data?.nome} onChange={onChangeNome} />
        <CustomInput placeholder="CPF" className="input-modal" value={data?.cpf} onChange={onChangeCpf} />
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
