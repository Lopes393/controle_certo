import { useState } from "react";
import { Button } from "react-bootstrap";
import CustomModalInfo from "./CustomModalInfo";
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
  setContacts: () => void;
  setDetail: (payload: any) => void;
};

const CustomButtonInfo: React.FC<CustomButtonProps> = ({
  className,
  text,
  variant,
  disable,
  setDisable,
  data,
  setContacts,
  setDetail,
}) => {
  const [showModal, setShowModal] = useState(false);
  const [title, setTitle] = useState("");

  const handleShowModal = () => {
    setTitle("Criar nova pessoa");

    if (data) {
      setTitle("Alterar pessoa");
    }

    setShowModal(true);
    setDisable(true);
  };

  const handleHideModal = () => {
    setShowModal(false);
    setDisable(false);
  };

  async function onSave(payload: any) {
    const response = await axios.post("http://localhost:8000/public/index/pessoas", payload);
    setContacts();
    setDetail(response.data.pessoa);
    setShowModal(false);
    setDisable(false);
    Swal.fire({
      icon: response.data.status,
      title: response.data.title,
    });
  }
  async function onEdit(payload: any) {
    const response = await axios.put("http://localhost:8000/public/index/pessoas/" + payload.id, payload);
    setContacts();
    setDetail(response.data.pessoa.id);
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
      <CustomModalInfo
        show={showModal}
        onHide={handleHideModal}
        onSubmit={data ? onEdit : onSave}
        title={title}
        data={data}
      />
    </>
  );
};

export default CustomButtonInfo;
