<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ?></title>

  <style>
    a:link,
    a:visited {
      color: inherit;
      text-decoration: none;
    }

    .clickable:hover {
      background: rgba(0, 0, 0, 0.2);
    }

    .card {
      border-radius: 5px;
      padding: 1px 10px 5px 10px;
      width: 400px;
      min-height: 210px;
      background: white;
      box-shadow: 1px 2px 4px 0px rgba(0, 0, 0, 0.3);
      overflow: auto;
    }

    .f-right {
      float: right;
      margin-left: 5px !important;
    }

    table.view,
    td.view {
      border: solid 1px #BDBDBD;
      border-collapse: collapse;
    }

    td {
      padding: 2px 10px;
    }

    .btn {
      margin: 10px 0;
      padding: 8px;
      border: none;
      border-radius: 5px;
      background: #ef6c00;
      cursor: pointer;
      color: white;
    }

    .blue {
      color: white;
      background: #1565C0;
    }

    .green {
      color: white;
      background: #43A047;
    }

    .badge {
      padding: 2px 4px;
      border-radius: 4px;
      text-align: center;
      font-size: 13px;
      cursor: pointer;
    }

    .delete {
      background: #ef5350;
      color: white;
    }

    .edit {
      background: #1565C0;
      color: white;
    }

    /* Alert Style by Robert Lemon */
    /* https://codepen.io/rlemon/pen/vmIlC */
    .alert {
      width: 30vw;
    }

    .alert .inner {
      padding: 12px;
      border-radius: 3px;
      border: 1px solid rgb(180, 180, 180);
      background-color: rgb(212, 212, 212);
    }

    .alert .close {
      float: right;
      cursor: pointer;
      padding: 12px;
    }

    .alert input {
      display: none;
    }

    .alert input:checked~* {
      animation-name: dismiss, hide;
      animation-duration: 300ms;
      animation-iteration-count: 1;
      animation-timing-function: ease;
      animation-fill-mode: forwards;
      animation-delay: 0s, 100ms;
    }

    .alert.success .inner {
      border: 1px solid rgb(214, 233, 198);
      background-color: rgb(223, 240, 216);
    }

    .alert.success .inner,
    .alert.success .close {
      color: rgb(70, 136, 71);
    }


    @keyframes dismiss {
      0% {
        opacity: 1;
      }

      90%,
      100% {
        opacity: 0;
        font-size: 0.1px;
        transform: scale(0);
      }
    }

    @keyframes hide {
      100% {
        height: 0px;
        width: 0px;
        overflow: hidden;
        margin: 0px;
        padding: 0px;
        border: 0px;
      }
    }
  </style>
</head>