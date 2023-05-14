@extends('admin::layouts.master')

@section('title', __('admin/jumps.index'))

@section('page-title-right')
  <a href="{{ admin_route('settings.index') }}?tab=tab-checkout&line=tax_address" class="btn btn-outline-info"
     target="_blank">跳转设置</a>
@endsection

@section('content')
  <style>

    .key-word-textarea {
      overflow: hidden;
      box-shadow: 0px -1px 5px 0px rgba(220, 229, 255, 0.7);
      border-top: 1px solid #D3D5E0;
      border-bottom: 1px solid #D3D5E0;
      align-items: flex-start;

      .el-textarea ::v-deep {
          .el-textarea__inner {
            border: none;
            border-radius: 0;
            line-height: 20px;
            font-size: 14px;
            height: 172px !important;
            min-height: 172px !important;
          }
      }
    }
    .text-area-num-scroll {
      width: 28px;
      overflow: hidden;
      background: #F5F6FA;
      padding-top: 5px;
    }

    .text-area-num-box {
      min-height: 172px;
      overflow-y: auto;
      width: 38px;
    }

    .text-area-num {
      line-height: 1.51;
      width: 28px;
      text-align: center;
    }

    .flex {
      display: flex;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between; /* 对齐方式 */
    }

    .item {
      border: 1px solid black;
      box-sizing: border-box;
      padding: 10px;
    }
  </style>
  <ul class="nav-bordered nav nav-tabs mb-3">
    <li class="nav-item">
      <a class="nav-link active" href="{{ admin_route('jumps.index') }}">跳转设置</a>
    </li>
  </ul>

  <div id="tax-classes-app" class="card" v-cloak>
    <div class="card-body h-min-600">
      <div class="d-flex justify-content-between mb-4">
        <button type="button" class="btn btn-primary"
                @click="checkedCreate('add', null)">{{ __('common.add') }}</button>
      </div>
      <div class="table-push">
        <table class="table">
          <thead>
          <tr>
            <th>ID</th>
            <th>Url</th>
            <th>总点击</th>
            <th>目标URL</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th class="text-end">{{ __('common.action') }}</th>
          </tr>
          </thead>
          <tbody v-if="jumps.length">
          <tr v-for="jump, index in jumps" :key="index">
            <td>@{{ jump.id }}</td>
            <td>@{{ jump.url }}</td>
            <td>@{{ jump.to_url_visitor.visitorTotal }}</td>
            <td>
              <table class="el-table el-table--fit el-table--enable-row-hover el-table--enable-row-transition">
                <thead>
                <tr>
                  <th>索引</th>
                  <th>目标URL</th>
                  <th>点击量</th>
                  <th width="150px">最后点击时间</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(to_url, index) in jump.to_urls"  :key="index">
                  <td>@{{index + 1}}</td>
                  <td>@{{ to_url.to_url }}</td>
                  <td>
                      @{{ to_url.visitor || 0 }}
                  </td>
                  <td>@{{ to_url.visitor_time }}</td>
                  <td>
                  </td>
                </tr>
                </tbody>
              </table>
            </td>
            <td>@{{ jump.created_at }}</td>
            <td>@{{ jump.updated_at }}</td>
            <td class="text-end">
              <button class="btn btn-outline-secondary btn-sm"
                      @click="checkedCreate('edit', index)">{{ __('common.edit') }}</button>
              <button class="btn btn-outline-danger btn-sm ml-1" type="button"
                      @click="deleteCustomer(jump.id, index)">{{ __('common.delete') }}</button>
            </td>
          </tr>
          </tbody>
          <tbody v-else>
          <tr>
            <td colspan="7" class="border-0">
              <x-admin-no-data/>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      {{-- {{ $tax_rates->links('admin::vendor/pagination/bootstrap-4') }} --}}
    </div>

    <el-dialog title="跳转url" :visible.sync="dialog.show" width="800px"
               @close="closeCustomersDialog('form')" :close-on-click-modal="false">
      <el-form ref="form" :rules="rules" :model="dialog.form" label-width="100px">
        <el-form-item label="URL" prop="name">
          <el-input v-model="dialog.form.url" placeholder="url"></el-input>
        </el-form-item>
        <el-form-item label="目标链接">
          <div class="key-word-textarea flex">
            <div class="text-area-num-scroll ">
              <div class="text-area-num-box" ref="textAreaNumBox">
                <div v-for="(t,i) in textAreaNum" :key="i" class="text-area-num">@{{i + 1}}</div>
              </div>
            </div>
            <el-input
              type="textarea"
              placeholder="请输入url"
              v-model="dialog.form.to_urls"
              rows="30"
            >
            </el-input>
          </div>
        </el-form-item>

        <el-form-item class="mt-5">
          <el-button type="primary" @click="addFormSubmit('form')">{{ __('common.save') }}</el-button>
          <el-button @click="closeCustomersDialog('form')">{{ __('common.cancel') }}</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
@endsection

@push('footer')
  <script>
    new Vue({

      el: '#tax-classes-app',
      computed: {
        textAreaNum() {
          return 30
        }
      },
      data: {
        jumps: @json($jumps ?? []),

        source: {
          all_jumps: @json($all_jumps ?? []),
        },

        dialog: {
          show: false,
          index: null,
          type: 'add',
          form: {
            id: null,
            url: '',
            to_urls: '',
          },
        },

        rules: {}
      },

      methods: {
        checkedCreate(type, index) {
          this.dialog.show = true
          this.dialog.type = type
          this.dialog.index = index

          if (type == 'edit') {
            let url = this.jumps[index];
            var numleft = [];
            let t = '';
            for (let i = 0; i < url.to_urls.length; i++) {//其实就是按行拆，加上\n而已，相当于“a\n b\n c\n”
              url.to_urls[i]['to_url'] = url.to_urls[i]['to_url'].replace("\r", "");
              numleft.push(url.to_urls[i]['to_url'] + "\n")
              t += url.to_urls[i]['to_url'] + "\n"
            }
            this.dialog.form = {
              id: url.id,
              url: url.url,
              to_urls: t,
            }
          }
        },

        deleteRates(index) {
          this.dialog.form.jumps.splice(index, 1)
        },

        addFormSubmit(form) {
          const self = this;
          const type = this.dialog.type == 'add' ? 'post' : 'put';
          const url = this.dialog.type == 'add' ? 'jumps' : 'jumps/' + this.dialog.form.id;

          this.$refs[form].validate((valid) => {
            if (!valid) {
              this.$message.error('{{ __('common.error_form') }}');
              return;
            }

            $http[type](url, this.dialog.form).then((res) => {
              this.$message.success(res.message);
              if (this.dialog.type == 'add') {
                this.jumps.push(res.data)
              } else {
                this.jumps[this.dialog.index] = res.data
              }

              this.dialog.show = false
            })
          });
        },

        deleteCustomer(id, index) {
          const self = this;
          this.$confirm('{{ __('common.confirm_delete') }}', '{{ __('common.text_hint') }}', {
            confirmButtonText: '{{ __('common.confirm') }}',
            cancelButtonText: '{{ __('common.cancel') }}',
            type: 'warning'
          }).then(() => {
            $http.delete('jumps/' + id).then((res) => {
              this.$message.success(res.message);
              self.jumps.splice(index, 1)
            })
          }).catch(() => {
          })
        },

        closeCustomersDialog(form) {
          this.$refs[form].resetFields();
          Object.keys(this.dialog.form).forEach(key => this.dialog.form[key] = '')
          this.dialog.show = false
        }
      }
    })
  </script>
@endpush
