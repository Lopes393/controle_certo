import { useState } from "react";
import { Button } from "react-bootstrap";
import CustomModalContact from "./CustomModalContact";
import axios from "axios";
import Swal from "sweetalert2";
import { FaEdit } from "react-icons/fa";

type CustomButtonProps = {
  className?: string;
  text?: string;
  variant?: string;
  disable: boolean;
  setDisable: any;
  data?: any;
  idPessoa: number;
  icon?: string;
  setDetail: (payload: any) => void;
};

const CustomButton: React.FC<CustomButtonProps> = ({
  className,
  text,
  variant,
  disable,
  setDisable,
  data,
  idPessoa,
  setDetail,
}) => {
  const [showModal, setShowModal] = useState(false);
  const [title, setTitle] = useState("");

  const handleShowModal = () => {
    setTitle("Criar novo contato");

    if (data) {
      setTitle("Alterar contato");
    }
    setShowModal(true);
    setDisable(true);
  };

  const handleHideModal = () => {
    setShowModal(false);
    setDisable(false);
  };

  async function onSave(payload: any) {
    payload = { ...payload, id_people: idPessoa };
    const response = await axios.post("http://localhost:8000/public/index/contatos", payload);
    setDetail(idPessoa);
    setShowModal(false);
    setDisable(false);
    Swal.fire({
      icon: response.data.status,
      title: response.data.title,
    });
  }
  async function onEdit(payload: any) {
    payload = { ...payload, id_people: idPessoa };
    const response = await axios.put("http://localhost:8000/public/index/contatos/" + payload.id, payload);
    setDetail(idPessoa);
    setShowModal(false);
    setDisable(false);
    Swal.fire({
      icon: response.data.status,
      title: response.data.title,
    });
  }

  return (
    <>
      <Button className={className} variant={variant} onClick={handleShowModal} disabled={disable}>
        {text}
        {data ? <FaEdit /> : <></>}
      </Button>
      <CustomModalContact
        show={showModal}
        onHide={handleHideModal}
        onSubmit={data ? onEdit : onSave}
        title={title}
        data={data}
      />
    </>
  );
};

export default CustomButton;
